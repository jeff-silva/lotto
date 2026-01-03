import axios from "axios";
import _ from "lodash";

export default (opts = {}) => {
  // const app = useApp();

  opts = {
    method: "get",
    url: "",
    params: {},
    data: {},
    headers: {},
    response: null,
    valid: () => true,
    onSubmit: () => null,
    onSuccess: () => null,
    onError: () => null,
    ...opts,
  };

  const meta = reactive({
    submitTimeout: null,
    error: null,
  });

  const event = reactive({
    items: [],
    on: (name, call) => {
      event.items.push({ name, call });
    },
    dispatch: (name, arg1) => {
      for (const ev of event.items) {
        if (ev.name != name) continue;
        ev.call(arg1);
      }
    },
  });

  const r = reactive({
    ...opts,
    busy: false,
    ready: false,

    on: event.on,
    dispatch: event.dispatch,

    errorExists() {
      return meta.error?.response?.data?.message ? true : false;
    },

    errorMessage() {
      return meta.error?.response?.data?.message || "Erro indefinido";
    },

    errorMessages(field) {
      if (!meta.error?.response?.data?.errors) {
        return [];
      }
      return meta.error.response.data.errors[field] || [];
    },

    errorClear() {
      meta.error = null;
    },

    applyOpts(opts = {}) {
      const defaults = {
        method: null,
        url: null,
        params: {},
        data: {},
        headers: {},
      };

      for (const attr in defaults) {
        let value = opts[attr] || defaults[attr];
        if (typeof value == "function") {
          r[attr] = value();
        }
      }

      if (import.meta.dev) {
        r.url = `http://lotto.localhost${r.url}`;
      }

      return {
        method: r.method,
        url: r.url,
        params: r.params,
        data: r.data,
        headers: r.headers,
      };
    },

    submit() {
      const axiosOpts = r.applyOpts(opts);
      if (!axiosOpts.method) return null;
      if (!axiosOpts.url) return null;
      if (!r.valid()) return null;

      r.onSubmit();
      r.dispatch("submit");
      r.errorClear();

      return new Promise((resolve, reject) => {
        r.busy = true;

        if (meta.submitTimeout) {
          clearTimeout(meta.submitTimeout);
        }

        meta.submitTimeout = setTimeout(async () => {
          try {
            const resp = await axios(axiosOpts);
            r.response = resp.data;
            r.onSuccess(resp);
            r.dispatch("success", resp);
            resolve(resp);
          } catch (e) {
            meta.error = e;
            r.onError(meta.error);
            r.dispatch("error", meta.error);
            reject(meta.error);

            if (e.response && e.response.status == 401) {
              location.reload();
            }
          }

          r.busy = false;
          r.ready = true;
        }, 1000);
      });
    },
  });

  onUnmounted(() => {
    event.items = [];
  });

  return r;
};
