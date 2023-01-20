import { mount } from "@vue/test-utils";
import VDialog from "./index.vue";
import { describe, expect, test } from "vitest";

describe("test label button is same with props label", () => {
    test("display label button", () => {
        const wrapper = mount(VDialog, {
            props: {
                title: "Hello world",
                showModal: true,
            },
            slots: {
                close: "<div>Close</div>",
                content: "<div>Ini teks dialog</div>",
            },
        });
        expect(wrapper.text()).toContain("Hello world");
        expect(wrapper.html()).toContain("<div>Close</div>");
        expect(wrapper.html()).toContain("<div>Ini teks dialog</div>");
        expect(wrapper.html()).toContain("<div>Ini teks dialog</div>");
    });
});
