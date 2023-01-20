import { mount } from "@vue/test-utils";
import { describe, expect, test } from "vitest";
import VToast from "./index.vue";

describe("test props type", () => {
    test("renders the correct style for type props primary", () => {
        const wrapper = mount(VToast, {
            props: {
                type: "primary",
            },
        });
        expect(wrapper.find(".bg-indigo-500").exists()).toBe(true);
        expect(wrapper.find(".bg-rose-500").exists()).toBe(false);
    });
    test("renders the correct style for type props success", () => {
        const wrapper = mount(VToast, {
            props: {
                type: "success",
            },
        });
        expect(wrapper.find(".bg-emerald-500").exists()).toBe(true);
        expect(wrapper.find(".bg-bluesky-500").exists()).toBe(false);
    });
    test("renders the correct style for type props error", () => {
        const wrapper = mount(VToast, {
            props: {
                type: "error",
            },
        });
        expect(wrapper.find(".bg-rose-500").exists()).toBe(true);
        expect(wrapper.find(".bg-indigo-500").exists()).toBe(false);
    });
    test("renders the correct style for type props warning", () => {
        const wrapper = mount(VToast, {
            props: {
                type: "warning",
            },
        });
        expect(wrapper.find(".bg-amber-500").exists()).toBe(true);
        expect(wrapper.find(".bg-orange-500").exists()).toBe(false);
    });
});

describe("test close button", () => {
    test("show toast when open true", () => {
        const wrapper = mount(VToast, {
            props: {
                open: true,
            },
        });
        const button = wrapper.find("button");
        button.trigger("click");
        expect(wrapper.vm.open).toBe(false);
    });
});

describe("test slot text", () => {
    test("layout text slot", () => {
        const wrapper = mount(VToast, {
            slots: {
                text: "<div>Text from slot</div>",
            },
        });
        expect(wrapper.html()).toContain("<div>Text from slot</div>");
    });
});
