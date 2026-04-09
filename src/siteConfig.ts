import type {
  SiteConfiguration,
  NavigationLinks,
  SocialLinks,
} from "./types.ts";

export const SITE: SiteConfiguration = {
  title: "CassiGS Studio",
  description: "A studio art site based on the Barebones template",
  href: "https://studio.cassigs.com",
  author: "Cassi Gallagher-Shearer",
  locale: "en-CA",
};

export const NAV_LINKS: NavigationLinks = {
  posts: {
    path: "/posts",
    label: "Posts",
  },
  projects: {
    path: "/projects",
    label: "Projects",
  },
  documentation: {
    path: "/docs",
    label: "Documentation",
  },
};

export const SOCIAL_LINKS: SocialLinks = {
  email: {
    label: "Email",
    href: "mailto:ccgall@gmail.com",
  },
  github: {
    label: "GitHub",
    href: "https://github.com/CassiGS",
  },
};
