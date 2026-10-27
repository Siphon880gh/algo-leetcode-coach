## Enumerate pairs of distinct heights

1. cnt = height counts.
2. For each height x: t[x] += cnt[x]; t[2x] += ⌊cnt[x] / 2⌋.
3. For each pair of heights x < y: t[x + y] += min(cnt[x], cnt[y]).
4. Return max(t).

Examples → 4, 1. Checked against best matching for every target height on 500 random arrays.

Leaving out pairs of different heights: example 1 → 3 instead of 4.

Time: O(n + m²), m ≤ 1000 distinct heights  
Space: O(m²)

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
