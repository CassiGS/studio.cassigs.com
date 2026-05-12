import { defineCollection } from "astro:content";
import { z } from "astro/zod";
import { glob } from "astro/loaders";

const posts = defineCollection({
  loader: glob({ pattern: "**/[^_]*.{md,mdx}", base: "./src/content/posts" }),
  schema: ({ image }) =>
    z.object({
      title: z.string(),
      description: z.string(),
      publicationDate: z.date(),
      image: image().optional(),
      imageAlt: z.string().optional(),
      tags: z.array(z.string()).optional(),
    }),
});

const portfolio = defineCollection({
  loader: glob({ pattern: "**/*.{md,mdx}", base: "./src/content/portfolio" }),
  schema: () =>
    z.object({
      title: z.string(),
      featureImage: z.string(),    // path to the hero image
      year: z.string().optional(),
      blogLink: z.string().optional(),
      client: z.string().optional(),
      medium: z.string().optional(),
  })
})
export const collections = { posts, portfolio };
