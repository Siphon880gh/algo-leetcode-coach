## Check t

1. If n(n + 1) / 2 < k, return −1.
2. count(t): mark order[0 … t] as stars; for each star-free gap of length g subtract g(g + 1) / 2 from n(n + 1) / 2.
3. Binary search the smallest t with count(t) ≥ k.

Examples → 0, 2, −1. Checked against counting substrings directly on 1,000 random cases.

Adding (i + 1) · (n − i) for each star on its own (substrings with two stars count twice): example 2 → 1 instead of 2.

Time: O(n log n)  
Space: O(n)

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
