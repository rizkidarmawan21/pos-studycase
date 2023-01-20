import { mount } from "@vue/test-utils";
import { describe, expect, test } from "vitest";
import VBreadcrumb from "./index.vue";

describe("test label path", () => {
    test("display correct label", () => {
        const wrapper = mount(VBreadcrumb, {
            props: {
                routes: [
                    {
                        name: "Dashboard",
                        active: false,
                        to: "/v2/dashboard",
                    },
                    {
                        name: "Employee",
                        active: true,
                        to: "/v2/employee",
                    },
                ],
            },
        });
        const activePath = wrapper.find('a[id="active"]');
        const passivePath = wrapper.find('a[id="passive"]');
        expect(wrapper.text()).toBe("DashboardEmployee");
        expect(activePath.classes()).toStrictEqual([
            "hover:text-primary",
            "text-primary",
        ]);
        expect(activePath.attributes("href")).toBe("#");
        expect(passivePath.classes()).toStrictEqual([
            "hover:text-primary",
            "text-slate-500",
        ]);
        expect(passivePath.attributes("href")).toBe("/v2/dashboard");
    });
});
