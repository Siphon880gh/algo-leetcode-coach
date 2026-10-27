## Difference map

`book(s, e)`: `delta[s] += 1`, `delta[e] −= 1`. Then walk the keys in sorted order with a running sum, track its maximum, and return it.

The running sum at a point is how many bookings cover it. Because intervals are half-open, one ending at `t` and another starting at `t` share the key `t`, where their `−1` and `+1` combine, so they never count as overlapping.

That is O(n) per booking with a sorted map, O(n²) total, fine for 400 calls.

**Faster:** a dynamic (lazily created) segment tree over `[0, 10⁹]` with range add and a global max gives O(log C) per booking.

Do not keep a counter per time unit; times go up to 10⁹. Do not reset the maximum between bookings unless you recompute it; the answer never decreases.

Time: O(n) per booking with the sweep  
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
