Each day, every element except the first and last changes at once: it goes up by 1 if it is smaller than both neighbours, and down by 1 if it is larger than both. Return the array once it stops changing. For instance, `[6,2,3,4]` becomes `[6,3,3,4]`, and `[1,6,3,4,3,5]` becomes `[1,4,4,4,4,5]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Copy, then compare

1. Loop: `b = a[:]`.
2. For `i` in `1..n − 2`: if `a[i] < a[i − 1]` and `a[i] < a[i + 1]`, `b[i] += 1`; if `a[i] > a[i − 1]` and `a[i] > a[i + 1]`, `b[i] −= 1`.
3. If `b == a`, return `a`; else `a = b`.

Every change moves a value toward its neighbours, so the process settles.

Do not update in place; a changed value would affect its neighbour on the same day. Do not change the first or last element.

Time: O(n · days), small for short arrays with small values  
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
