You are given two integer arrays nums1 and nums2 of the same length n. A range [l, r] is balanced for a choice that picks, at every index i in it, either nums1[i] or nums2[i], when the picked nums1 values sum to the same as the picked nums2 values. Two balanced ranges differ if their l, r, or any choice differ. Return the number of different balanced ranges, modulo 10^9 + 7. For instance, nums1 = [1,2,5], nums2 = [2,6,3] → 3, and nums1 = [0,1], nums2 = [1,0] → 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Difference counts per ending index

1. `prev` = empty map.
2. At `i`: `cur[+a] += 1`, `cur[−b] += 1` (ranges starting at `i`); for each `(d, c)` in `prev`: `cur[d + a] += c`, `cur[d − b] += c`.
3. `ans += cur[0]` (mod); `prev = cur`.

Constructed checks (verified by enumerating every range and every choice on small random arrays): the two cases above → 3, 4.

Picking from nums1 adds to the difference and picking from nums2 subtracts, so balanced means difference 0. The map size is bounded by the span of reachable sums; an array with an offset works the same.

Time: O(n · D) for D reachable differences  
Space: O(D)

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
