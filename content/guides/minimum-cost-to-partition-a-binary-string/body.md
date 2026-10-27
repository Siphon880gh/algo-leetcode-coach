## Recurse

1. P = prefix counts of '1'.
2. go(l, r): L = r − l, X = P[r] − P[l]; d = flatCost if X = 0 else L · X · encCost. If L is even, d = min(d, go(l, mid) + go(mid, r)).
3. Return go(0, n).

Costs reach 10^15, so use 64-bit integers.

Examples → 6, 12, 2. Checked against a memoized search on 1,500 random strings.

Always splitting as far as possible: example 2 → 26 instead of 12.

Time: O(n log n)  
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
