## Emails are the nodes

Names are not unique, so link through emails:

1. For each account, union every email with its first email. Record `owner[email] = name`.
2. Group all emails by `find(email)`.
3. For each group, sort the emails and output `[owner[root]] + sorted_emails`.

Two accounts that share any email end up in one component, even through a chain of other accounts.

A DFS works too: build a graph linking each account's first email to the others, and collect connected components.

Do not merge accounts by name; two different people can share a name. Do not merge only accounts that directly share an email; transitive links matter.

Time: O(E log E), for E total emails, dominated by sorting  
Space: O(E)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
