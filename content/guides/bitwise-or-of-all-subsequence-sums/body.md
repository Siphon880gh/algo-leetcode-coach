Given an integer array nums of non-negative values, return the bitwise OR of the sums of all its subsequences. For instance, [2,1,0,3] → 7 and [0,0,0] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Elements and prefixes

1. `ans = 0`, `p = 0`.
2. For each `x`: `p += x`; `ans |= x | p`.
3. Return `ans`.

Constructed checks (verified against enumerating every subsequence on 400 random arrays): the cases above → 7, 0.

Every element and prefix sum is itself a subsequence sum, so nothing extra is added. The check above confirms that no other sum sets a new bit. Sums can pass 32-bit range for large inputs, so use 64-bit.

Time: O(n)  
Space: O(1)

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
