Two sensors record the same sequence of readings. One of them may be faulty: it skipped exactly one reading, so its later values shift left by one and its last value is something else (as the statement describes). Return which sensor (1 or 2) is faulty, or −1 if it cannot be determined or neither is. For instance, [2,3,4,5] and [2,1,3,4] → 1, [2,3,2,2,3,2] and [2,3,2,3,2,7] → 2, and [2,2,2,2,2] and [2,2,2,2,5] → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Shift and compare

1. `i` = first index with `s1[i] ≠ s2[i]`; none, or `i = n − 1` → −1.
2. `f1 = s1[i : n − 1] == s2[i + 1 : n]` (sensor 1 skipped `s2[i]`).
3. `f2 = s2[i : n − 1] == s1[i + 1 : n]`.
4. Exactly one true → that sensor; else −1.

Constructed checks (verified with code): the three cases above → 1, 2, −1.

A difference only at the last index is ambiguous: either sensor could have dropped it. When both shifts fit, the data cannot tell them apart.

Time: O(n)  
Space: O(1) with index comparisons

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
