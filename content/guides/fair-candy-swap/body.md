## One equation, one unknown

After the swap both totals match: `sumA − x + y = sumB − y + x`, so `x − y = (sumA − sumB) / 2 = delta`.

1. Compute `delta`.
2. Put `bobSizes` in a set.
3. For each `x` in `aliceSizes`, if `x − delta` is in the set, return `[x, x − delta]`.

The problem guarantees an answer, and the totals differ by an even number.

Do not try every pair; that is O(n · m). Do not swap the sign of `delta`; Alice gives `x` and receives `y = x − delta`.

Time: O(n + m)  
Space: O(m)

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
