## Earliest improvement

1. For each `i` with `number[i] = digit`: if `number[i + 1] > digit`, return the string without `i`.
2. Otherwise remove the last occurrence.

Examples → `12`, `231`, `51`. Checked against trying every occurrence on 300 random strings.

All results have the same length, so the first position that changes decides. Removing before a larger digit makes that position bigger; otherwise removing as late as possible keeps the prefix unchanged longest. Trying every occurrence also works for n ≤ 100.

Time: O(n)  
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
