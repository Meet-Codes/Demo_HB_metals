import { cn } from "@/lib/utils";
import React, { useState } from "react";

export type FaqItem = {
    question: string;
    answer: string;
};

export interface FaqSectionProps {
    faqs?: FaqItem[];
    imageSrc?: string;
    badgeText?: string;
    title?: string;
    subtitle?: string;
    className?: string;
}

const DEFAULT_FAQS: FaqItem[] = [
    {
        question: "What is the standard Minimum Order Quantity (MOQ)?",
        answer: "For most of our primary products—including Magnesium Metal Powder, Sodium Tungstate, and Tungsten Trioxide—the standard MOQ is 25 Kilograms. We also accommodate custom evaluation lots and full container-load industrial supplies upon quotation.",
    },
    {
        question: "How are sensitive metal powders and tungstate salts packaged?",
        answer: "All products are packed in robust, moisture-proof containers such as heavy-gauge HDPE drums or metal barrels lined with double sealed polythene bags to prevent oxidation and moisture ingress during transport.",
    },
    {
        question: "Do you provide Certificates of Analysis (COA) with dispatched shipments?",
        answer: "Yes. Every dispatched commercial batch is tested against standardized quality parameters, and an authentic lot-specific Certificate of Analysis (COA) is supplied with the shipment documentation.",
    },
    {
        question: "Can HB Metals accommodate customized particle size and mesh specifications?",
        answer: "Yes. For products like Magnesium Metal Powder and Tungsten Powders, our high-speed automatic processing allows custom screen sizing and mesh classification tailored to pyrotechnic, metallurgical, or chemical synthesis requirements.",
    },
];

export default function FaqSection({
    faqs = DEFAULT_FAQS,
    imageSrc = "/assets/images/hero/slide-lab.jpg",
    badgeText = "FAQ's",
    title = "Looking for answer?",
    subtitle = "Verified commercial, chemical specifications and packaging answers directly from HB Metals technical operations.",
    className = "",
}: FaqSectionProps) {
    const [openIndex, setOpenIndex] = useState<number | null>(0);

    return (
        <section className={cn("py-16 bg-slate-50", className)}>
            <div className="max-w-5xl mx-auto flex flex-col md:flex-row items-start justify-center gap-10 px-4 md:px-6">
                <div className="w-full md:w-5/12 shrink-0">
                    <img
                        className="w-full rounded-2xl shadow-lg h-auto object-cover border border-slate-200"
                        src={imageSrc}
                        alt="HB Metals Laboratory & Testing Facility"
                        width={480}
                        height={400}
                    />
                </div>
                <div className="w-full md:w-7/12">
                    <p className="text-amber-700 text-sm font-semibold tracking-wider uppercase mb-1">{badgeText}</p>
                    <h2 className="text-3xl font-bold text-slate-900 tracking-tight">{title}</h2>
                    <p className="text-sm text-slate-600 mt-2 pb-6 border-b border-slate-200">
                        {subtitle}
                    </p>
                    <div className="divide-y divide-slate-200">
                        {faqs.map((faq, index) => {
                            const isOpen = openIndex === index;
                            return (
                                <div
                                    className="py-4 cursor-pointer group"
                                    key={index}
                                    onClick={() => setOpenIndex(isOpen ? null : index)}
                                    role="button"
                                    aria-expanded={isOpen}
                                    tabIndex={0}
                                    onKeyDown={(e) => {
                                        if (e.key === "Enter" || e.key === " ") {
                                            e.preventDefault();
                                            setOpenIndex(isOpen ? null : index);
                                        }
                                    }}
                                >
                                    <div className="flex items-center justify-between gap-4">
                                        <h3 className={cn("text-base font-medium transition-colors", isOpen ? "text-amber-700 font-semibold" : "text-slate-800 group-hover:text-slate-950")}>
                                            {faq.question}
                                        </h3>
                                        <svg
                                            width="18"
                                            height="18"
                                            viewBox="0 0 18 18"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            className={cn("shrink-0 transition-transform duration-300 ease-in-out", isOpen ? "rotate-180 text-amber-700" : "text-slate-500")}
                                        >
                                            <path d="m4.5 7.2 3.793 3.793a1 1 0 0 0 1.414 0L13.5 7.2" stroke="currentColor" strokeWidth="1.75" strokeLinecap="round" strokeLinejoin="round" />
                                        </svg>
                                    </div>
                                    <div
                                        className={cn(
                                            "overflow-hidden transition-all duration-300 ease-in-out",
                                            isOpen ? "max-h-96 opacity-100 pt-3" : "max-h-0 opacity-0"
                                        )}
                                    >
                                        <p className="text-sm text-slate-600 leading-relaxed">
                                            {faq.answer}
                                        </p>
                                    </div>
                                </div>
                            );
                        })}
                    </div>
                </div>
            </div>
        </section>
    );
}

export { FaqSection as App };
