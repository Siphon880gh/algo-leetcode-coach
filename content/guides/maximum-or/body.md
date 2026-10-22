## Prefix and suffix OR

1. `pre[i]` = OR of `nums[0..i−1]`, `suf[i]` = OR of `nums[i..]`.
2. Return `max over i of pre[i] | (nums[i] << k) | suf[i + 1]`.

Examples → 30, 35. Checked against trying every split of the k doublings on 300 random inputs.

The highest set bit of the result decides most; giving all k shifts to one number pushes some bit k places up, which no split can match. Values reach 10^9 · 2^15 ≈ 3.3 · 10^13, so use 64-bit.

Time: O(n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
