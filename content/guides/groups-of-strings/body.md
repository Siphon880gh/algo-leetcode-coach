## Shared keys instead of pairwise checks

1. Map each mask to the first word that has it (identical masks join).
2. For each word with mask `m` and each letter `b` in it: join with the word whose mask is `m ^ b` (delete/add), and join through a wildcard key `(m ^ b, *)` (replace).
3. Return `[number of components, largest component]`.

Examples → `[2,3]`, `[1,3]`. Checked against testing every pair with set operations on random word lists.

Replacing a letter in one word gives the other exactly when both lose one letter and meet; the wildcard key captures that without comparing all pairs. Up to 2 · 10^4 words × 26 letters keeps it near linear.

Time: O(26 · n · α(n))  
Space: O(26 · n)

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
