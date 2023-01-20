import { mount } from "@vue/test-utils";
import { describe, expect, test } from "vitest";
import VCheckbox from "./index.vue";

describe("checkbox component", () => {
    test("test input checkbox display correct style", () => {
        const wrapper = mount(VCheckbox, {
            props: {
                label: "Life Assurance",
            },
        });
        const inputWithTypeCheckbox = wrapper.find("input");
        const span = wrapper.find("span");
        expect(inputWithTypeCheckbox.attributes("type")).toBe("checkbox");
        expect(inputWithTypeCheckbox.classes()).toStrictEqual([
            "form-checkbox",
        ]);
        expect(wrapper.text()).toBe("Life Assurance");
        expect(span.classes()).toStrictEqual([
            "text-sm",
            "text-slate-600",
            "ml-2",
        ]);
    });
});
