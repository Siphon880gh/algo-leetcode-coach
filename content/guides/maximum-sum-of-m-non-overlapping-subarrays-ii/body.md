## Penalty search

1. run(λ): f[i] = max(f[i − 1], P[i] − λ + max over t in [i − r, i − l] of f[t] − P[t]), keeping fewer subarrays on ties. Return (f[n], count).
2. λ = 0 with count 0 (all sums negative) → return the best single subarray with length in [l, r].
3. λ = 0 with count ≤ m → return f[n].
4. Otherwise binary search the smallest λ with count ≤ m; return f[n] + λ · m.

Examples → 7, 8, 6, −1. Checked against the layered DP on 2,000 random arrays.

Ignoring the length limits: example 3 → 7 instead of 6.

Time: O(n log S), S = largest possible sum  
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
