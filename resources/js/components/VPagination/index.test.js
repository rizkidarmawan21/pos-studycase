import { mount } from "@vue/test-utils";
import { describe, expect, test } from "vitest";
import VPagination from "./index.vue";

describe("button pagination show correct data", () => {
    test("test button with current page 1", () => {
        const wrapper = mount(VPagination, {
            props: {
                pagination: {
                    current_page: 1,
                },
            },
        });
        const backButton = wrapper.find('button[name="previous"]');
        expect(backButton.text()).toContain("Previous");
        expect(backButton.classes()).toStrictEqual([
            "btn",
            "bg-white",
            "border-slate-200",
            "cursor-not-allowed",
            "text-slate-300",
        ]);
        const nextButton = wrapper.find('button[name="next"]');
        expect(nextButton.text()).toContain("Next");
        expect(nextButton.classes()).toStrictEqual([
            "btn",
            "bg-white",
            "border-slate-200",
            "hover:border-slate-300",
            "text-primary",
            "cursor-pointer",
        ]);
    });
    test("test button with current page more than 1", () => {
        const wrapper = mount(VPagination, {
            props: {
                pagination: {
                    current_page: 4,
                },
            },
        });
        const backButton = wrapper.find('button[name="previous"]');
        expect(backButton.classes()).toStrictEqual([
            "btn",
            "bg-white",
            "border-slate-200",
            "hover:border-slate-300",
            "text-primary",
            "cursor-pointer",
        ]);
        const nextButton = wrapper.find('button[name="next"]');
        expect(nextButton.classes()).toStrictEqual([
            "btn",
            "bg-white",
            "border-slate-200",
            "hover:border-slate-300",
            "text-primary",
            "cursor-pointer",
        ]);
    });
    test("test button with current page same with total pages", () => {
        const wrapper = mount(VPagination, {
            props: {
                pagination: {
                    current_page: 4,
                    total_pages: 4,
                },
            },
        });
        const backButton = wrapper.find('button[name="previous"]');
        expect(backButton.classes()).toStrictEqual([
            "btn",
            "bg-white",
            "border-slate-200",
            "hover:border-slate-300",
            "text-primary",
            "cursor-pointer",
        ]);
        const nextButton = wrapper.find('button[name="next"]');
        expect(nextButton.classes()).toStrictEqual([
            "btn",
            "bg-white",
            "border-slate-200",
            "cursor-not-allowed",
            "text-slate-300",
        ]);
    });
});
describe("showing appropriate text", () => {
    test("if current page = 1", () => {
        const wrapper = mount(VPagination, {
            props: {
                pagination: {
                    count: 10,
                    current_page: 1,
                    per_page: 10,
                    total: 33,
                    total_pages: 3,
                },
            },
        });
        const showLabel = wrapper.find('div[id="label-pagination"]');
        expect(showLabel.text()).toBe("Showing 1 to 10 of 33 results");
        expect(showLabel.attributes("id")).toBe("label-pagination");
        expect(showLabel.find("span").classes()).toStrictEqual([
            "font-medium",
            "text-slate-600",
        ]);
    });
    test("if current page = 2", () => {
        const wrapper = mount(VPagination, {
            props: {
                pagination: {
                    count: 10,
                    current_page: 2,
                    per_page: 10,
                    total: 33,
                    total_pages: 3,
                },
            },
        });
        const showLabel = wrapper.find('div[id="label-pagination"]');
        expect(showLabel.text()).toBe("Showing 11 to 20 of 33 results");
    });
    test("if current page = total pages", () => {
        const wrapper = mount(VPagination, {
            props: {
                pagination: {
                    count: 3,
                    current_page: 4,
                    per_page: 10,
                    total: 33,
                    total_pages: 4,
                },
            },
        });
        const showLabel = wrapper.find('div[id="label-pagination"]');
        expect(showLabel.text()).toBe("Showing 31 to 33 of 33 results");
    });
    test("if no data found", () => {
        const wrapper = mount(VPagination, {
            props: {
                pagination: {
                    count: 0,
                    current_page: 1,
                    per_page: 10,
                    total: 0,
                    total_pages: 1,
                },
            },
        });
        const showLabel = wrapper.find('div[id="not-found-data"]');
        expect(showLabel.text()).toBe("Showing 0 to 0 of 0 results");
    });
});
