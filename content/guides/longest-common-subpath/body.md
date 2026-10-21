## Monotone length, hashed windows

1. `ok(L)`: set of window hashes of length `L` for the first path; intersect with each next path's set; empty → false.
2. Largest `L` in `[0, min length]` with `ok(L)` (upper mid).

Example 1 → 2. Example 2 → 0. Example 3 → 1. Checked against brute force on random small paths.

Use two moduli (or a 61-bit Mersenne modulus plus a second one) to make collisions negligible; tests are designed to break single small-modulus hashes. Map city `c` to `c + 1` so city 0 is not a zero digit.

Time: O(S log S), S = total path length  
Space: O(S)

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
