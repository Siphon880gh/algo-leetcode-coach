## Subset DP

1. For every mask: cnt = total length, med = left-middle element of the union.
2. f[single list] = 0.
3. For other masks: try each split into part and rest; f[mask] = cnt[mask] + min(f[part] + f[rest] + |med[part] − med[rest]|).
4. Return f[all].

Examples → 18, 10, 4, 2. Checked against trying every merge order on 1,500 random cases.

Taking the median of an even list as the average of the two middle values: example 2 → 11.5 instead of 10.

Time: O(3^k + 2^k · S log S) with k lists and S total elements  
Space: O(2^k)

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
