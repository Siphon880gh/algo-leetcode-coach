Given parallel arrays of usernames, timestamps, and websites, a pattern is three websites in order. Its score is how many users visited those websites in that order (not necessarily consecutively). Return the pattern with the highest score, and the lexicographically smallest one on a tie. For instance, if two of three users each visit `home`, `about`, `career` in that order, `["home","about","career"]` wins with score 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count each user once per pattern

1. Sort the `(timestamp, user, website)` triples by timestamp.
2. Build each user's visit list in that order.
3. For each user, form the **set** of all 3-combinations (in order) of their list, and add 1 per pattern to a counter.
4. Return the pattern with the largest count, breaking ties by the smallest pattern.

Do not count a pattern twice for one user who visits it in several ways; the score counts users. Do not use only consecutive visits; any three in order count.

Time: O(n log n + Σ m³) for users with m visits  
Space: O(Σ m³)

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
