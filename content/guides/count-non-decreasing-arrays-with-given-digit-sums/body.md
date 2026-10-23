## DP over values

1. ds[v] = digit sum of v for v in 0 … 5000.
2. First position: cnt[v] = 1 if ds[v] = digitSum[0].
3. Next positions: pre = prefix sums of cnt; new cnt[v] = pre[v] if ds[v] = digitSum[i], else 0.
4. Return the sum of the last cnt mod 10^9 + 7.

Examples → 6, 4, 0. Checked against listing every array on 90 random small cases.

Requiring strictly increasing values: constructed check (run in code) [1, 1] → 6 instead of 10.

Time: O(n · 5001)  
Space: O(5001)

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
