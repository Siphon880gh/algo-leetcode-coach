`n` distinct points (1 to 500), coordinates −1e4 to 1e4. A boomerang is an ordered tuple `(i, j, k)` where the distance from `i` to `j` equals the distance from `i` to `k`. Order matters, so `(i, j, k)` and `(i, k, j)` both count. `[[0,0],[1,0],[2,0]]` → 2. `[[1,1],[2,2],[3,3]]` → 2. `[[1,1]]` → 0.

## Fix the center, group by distance

For each point `i`, build a hash map from squared distance to how many other points lie at that distance. If `c` points share a distance, they form `c · (c − 1)` ordered `(j, k)` pairs. Sum that over every distance and every center. An equivalent one-pass form: when you add a point at distance `d`, add `2 · cnt[d]` to the answer, then increment `cnt[d]`.

Use `dx² + dy²` as the key. Square roots bring floating-point error and are not needed — equal squared distances mean equal distances. The max squared distance is `2 · (2e4)² = 8e8`, which fits in 32 bits.

Line Reflection (356) and Max Points on a Line (149) are other point-hashing problems with different keys.

Do not count `c · (c − 1) / 2` — order matters here. Do not try all triples (O(n³)).

Time: O(n²)  
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
