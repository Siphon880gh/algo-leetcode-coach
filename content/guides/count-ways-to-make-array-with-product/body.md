## Distribute each exponent

1. Factor `k = p1^e1 · p2^e2 · …` by trial division up to √k.
2. For each prime, the `e` copies go into `n` slots: `C(n − 1 + e, e)` ways (stars and bars).
3. Multiply the binomials; a leftover prime `> √k` has `e = 1` and contributes `n`.

`[2,6]` → C(2,1) · C(2,1) = 4. `[4,4]` → C(5,2) = 10. `[73,660]` → 50734910.

Precompute factorials and inverse factorials up to about `n + 14` (exponents stay ≤ 13 for k ≤ 10^4). Do not count orderings of the factors directly; slots are positions, so stars and bars already handles order.

Time: O(q · √k)  
Space: O(n + log k)

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
