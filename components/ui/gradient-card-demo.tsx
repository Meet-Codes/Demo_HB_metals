// components/ui/gradient-card-demo.tsx

import { GradientCard } from "@/components/ui/gradient-card";

// Data for the cards to demonstrate reusability
const cardData = [
  {
    badgeText: "High-Speed Machinery",
    badgeColor: "#F59E0B", // Amber
    title: "Magnesium Products",
    description: "Precision manufactured magnesium metal powder and turnings produced using automatic milling.",
    ctaText: "Explore Magnesium",
    ctaHref: "/product-category/magnesium-products/",
    imageUrl: "/assets/images/magnesium-metal-powder.jpg",
    gradient: "orange" as const,
  },
  {
    badgeText: "Catalytic Grade",
    badgeColor: "#4B5563", // Gray
    title: "Sodium Tungstate",
    description: "High-grade Sodium Salt of Tungstic Acid and hydrate derivatives for catalytic synthesis.",
    ctaText: "Explore Tungstates",
    ctaHref: "/product-category/sodium-tungstate/",
    imageUrl: "/assets/images/sodium-tungstate.jpg",
    gradient: "gray" as const,
  },
  {
    badgeText: "High Thermal Endurance",
    badgeColor: "#8B5CF6", // Purple
    title: "Tungsten Powder",
    description: "Leading manufacturer of Tungsten Trioxide Powder, Tungstic Oxide and high density powders.",
    ctaText: "Explore Tungsten",
    ctaHref: "/product-category/tungsten-powder/",
    imageUrl: "/assets/images/tungsten-powder.jpg",
    gradient: "purple" as const,
  },
  {
    badgeText: "Strict Stoichiometry",
    badgeColor: "#10B981", // Green
    title: "Tungsten Oxide",
    description: "High-purity Tungsten Trioxide formulations synthesized for ceramic pigments and catalysts.",
    ctaText: "Explore Oxides",
    ctaHref: "/product-category/tungsten-oxide/",
    imageUrl: "/assets/images/tungsten-trioxide.jpg",
    gradient: "green" as const,
  },
];

const GradientCardDemo = () => {
  return (
    <div className="p-4 sm:p-8">
      <div className="grid grid-cols-1 gap-8 md:grid-cols-2 lg:gap-10">
        {cardData.map((card, index) => (
          <GradientCard
            key={index}
            badgeText={card.badgeText}
            badgeColor={card.badgeColor}
            title={card.title}
            description={card.description}
            ctaText={card.ctaText}
            ctaHref={card.ctaHref}
            imageUrl={card.imageUrl}
            gradient={card.gradient}
          />
        ))}
      </div>
    </div>
  );
};

export default GradientCardDemo;
