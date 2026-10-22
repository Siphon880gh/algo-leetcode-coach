## Three indices

1. `bad = lastMin = lastMax = −1`, `count = 0`.
2. For each `i`: if `nums[i]` is outside `[minK, maxK]`, `bad = i`; if it equals `minK`, `lastMin = i`; if it equals `maxK`, `lastMax = i`.
3. `count += max(0, min(lastMin, lastMax) − bad)`.
4. Return `count`.

Examples → 2, 10. Checked against testing every subarray on 300 random cases.

When minK = maxK, both indices update on the same values, as in Example 2. If minK > maxK nothing matches and the answer is 0. Counts reach about 5 · 10^9, so use 64-bit.

Time: O(n)  
Space: O(1)

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
