Given s, consider an n × n × n array whose entries are built from an index and the bitwise OR of the other two. Return the largest n whose total stays at most s. The exact formula and limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Factor the sum

This assumes entry (i, j, k) is i · (j OR k) with indices from 0; check the official formula.

1. total(n) = n(n − 1)/2 · O(n), where O(n) = Σ over j, k < n of (j OR k).
2. O(n + 1) = O(n) + 2 · Σ_{j<n} (j OR n) + n. Grow n while total(n + 1) ≤ s.

Constructed checks (run in code): s = 5 → 2, s = 100 → 3, s = 1000 → 5; s = 10^15 → 1196. Checked against summing the array directly for every s ≤ 400.

Summing all n³ entries for each n: about 5 · 10^11 steps by n = 1196.

Time: O(N²), N = the answer  
Space: O(1)

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
