## Bucket by offset

1. `record(name, t)`: insert `t` into a sorted list for `name`.
2. `query(freq, name, a, b)`: `size` from `freq`; `res = [0] * ((b − a) / size + 1)`.
3. For each `t` in `[a, b]` (found with binary search): `res[(t − a) / size] += 1`.

Recording 0, 60, 10: minute over `[0, 59]` → `[2]`; over `[0, 60]` → `[2,1]`. After 120: hour over `[0, 210]` → `[4]`.

Do not drop the last partial chunk; it still gets a bucket. Do not omit empty buckets; zeros must appear.

Time: O(log n + k + buckets) per query  
Space: O(n)

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
