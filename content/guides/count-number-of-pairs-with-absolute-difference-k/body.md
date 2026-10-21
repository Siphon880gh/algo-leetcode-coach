## Look back for x ± k

1. `cnt` = empty counter, `ans = 0`.
2. For each `x`: `ans += cnt[x − k] + cnt[x + k]`; `cnt[x] += 1`.

Examples → 4, 0, 3.

Because `k ≥ 1`, `x − k` and `x + k` are different values, so no pair is counted twice. With n ≤ 200 the O(n²) double loop also passes.

Time: O(n)  
Space: O(V)

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
