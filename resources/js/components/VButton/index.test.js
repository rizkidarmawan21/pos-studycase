// Import the `mount()` method from Vue Test Utils
import { mount } from "@vue/test-utils";
import VButton from "./index.vue";
import { describe, expect, test } from "vitest";

describe("test label button is same with props label", () => {
    test("display label button", () => {
        const wrapper = mount(VButton, {
            props: {
                label: "Hello world",
            },
        });
        expect(wrapper.text()).toContain("Hello world");
    });
});

describe("test button have emit with name click", () => {
    test("button have emit click", async () => {
        const wrapper = mount(VButton);
        wrapper.vm.$emit("click");
        await wrapper.vm.$nextTick();
        expect(wrapper.emitted("click")).toBeTruthy();
    });
});

describe("test props type button", () => {
    test("renders the correct style for type props primary", () => {
        const wrapper = mount(VButton, {
            props: {
                type: "primary",
            },
        });
        expect(wrapper.find(".bg-primary").exists()).toBe(true);
    });
    test("renders the correct style for type props danger", () => {
        const wrapper = mount(VButton, {
            props: {
                type: "danger",
            },
        });
        expect(wrapper.find(".bg-danger").exists()).toBe(true);
    });
    test("renders the correct style for type props success", () => {
        const wrapper = mount(VButton, {
            props: {
                type: "success",
            },
        });
        expect(wrapper.find(".bg-success").exists()).toBe(true);
    });
    test("renders the correct style for type props default", () => {
        const wrapper = mount(VButton, {
            props: {
                type: "default",
            },
        });
        expect(wrapper.find(".bg-white").exists()).toBe(true);
    });
});

describe("test props size button", () => {
    test("renders the correct style for size props medium", () => {
        const wrapper = mount(VButton, {
            props: {
                size: "medium",
            },
        });
        expect(wrapper.find(".btn").exists()).toBe(true);
    });
    test("renders the correct style for size props small", () => {
        const wrapper = mount(VButton, {
            props: {
                size: "small",
            },
        });
        expect(wrapper.find(".btn-sm").exists()).toBe(true);
    });
    test("renders the correct style for size props extrasmall", () => {
        const wrapper = mount(VButton, {
            props: {
                size: "extrasmall",
            },
        });
        expect(wrapper.find(".btn-xs").exists()).toBe(true);
    });
    test("renders the correct style for size props large", () => {
        const wrapper = mount(VButton, {
            props: {
                size: "large",
            },
        });
        expect(wrapper.find(".btn-lg").exists()).toBe(true);
    });
});
