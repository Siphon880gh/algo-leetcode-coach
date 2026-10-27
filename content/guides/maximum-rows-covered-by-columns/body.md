## Masks against masks

1. Turn each row into a bitmask `r`.
2. For each mask `s` of n bits with popcount numSelect: count rows with `r & ~s == 0`.
3. Return the largest count.

Examples → 3, 2.

There are at most C(12, 6) = 924 masks of the right size and 2^12 = 4096 masks overall, each checked against at most 12 rows. Rows of all zeros are covered by every set, which the bit test handles for free.

Time: O(2^n · m)  
Space: O(m)

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
