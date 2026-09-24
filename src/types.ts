export type SiteConfiguration = {
  title: string;
  description: string;
  href: string;
  author: string;
  locale: string;
};

export type NavigationLinks = {
  [key: string]: NavigationLink;
};

export type NavigationLink = {
  label: string;
  path: string;
};

export type SocialLinks = {
  [key: string]: SocialLink;
};

export type ContactLinks = {
  [key: string]: Contact;
};

export type Contact = {
  label: string;
  href: string;
};

export type SocialLink = {
  label: string;
  href: string;
};
