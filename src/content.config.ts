import { defineCollection } from 'astro:content';
import { z } from 'astro/zod';

const blogCollection = defineCollection({
  schema: ({ image }) => z.object({
    title: z.string(),
    pubDate: z.date(),
    description: z.string(),
    author: z.string(),
    image: image(),
    imageAlt: z.string(),
    tags: z.array(z.string()),
  }),
});

export const collections = {
  blog: blogCollection,
};
