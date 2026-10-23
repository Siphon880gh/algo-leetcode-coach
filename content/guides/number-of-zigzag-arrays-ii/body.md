## Matrix exponentiation

1. m = r − l + 1. A[v][w] = 1 if w ≥ m − v, else 0 (down[u] = up[m − 1 − u]).
2. Start from the all-ones vector (length 1) and apply A^(n − 1) with fast powering.
3. Return 2 · Σ of the result, mod 10^9 + 7.

Examples → 2, 10. Checked against the part I DP for n = 3 … 39 and m = 2 … 8.

Raising A to the power n: example 2 → 16 instead of 10 (that counts length n + 1).

Time: O(m³ log n)  
Space: O(m²)

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
