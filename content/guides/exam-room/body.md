## Three kinds of candidate seat

`n` can be 10⁹, so store only the occupied seats in a sorted list `S`.

`seat()`:

1. If `S` is empty, take seat 0.
2. Otherwise start with `best = 0`, `dist = S[0]` (sit at the left wall).
3. For each neighboring pair `a, b` in `S`: the middle seat `a + (b − a) // 2` is at distance `(b − a) // 2`. Take it if that is strictly larger.
4. The right wall: seat `n − 1` at distance `n − 1 − S[-1]`, again only if strictly larger.
5. Insert `best` into `S` and return it.

`leave(p)`: remove `p` from `S`.

Scanning left to right with strict `>` gives the lowest index on ties for free.

With at most 10⁴ calls, the O(k) scan is fine. For O(log n) per call, keep the gaps in a heap ordered by (distance, start) and lazily discard gaps that a `leave` has merged.

Do not allocate an array of `n` seats. Do not forget the two wall cases; they are measured to the wall, not halved.

Time: O(k) per call, k = people seated  
Space: O(k)

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
