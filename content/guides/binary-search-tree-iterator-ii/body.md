Design an iterator over a BST's in-order sequence that supports moving forward (`hasNext`, `next`) and backward (`hasPrev`, `prev`), as the statement specifies, starting before the smallest element. For instance, on a BST with values 3, 7, 9, 15, 20: next → 3, next → 7, prev → 3, next → 7, next → 9. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Stack + history

1. `stack` holds the left spine; `vals` stores values already produced; `idx` is the current position (−1 at the start).
2. `next()`: if `idx + 1 < len(vals)`, `idx += 1` and return it; else pop from the stack, push the right child's left spine, append, `idx += 1`.
3. `prev()`: `idx −= 1`, return `vals[idx]`. `hasPrev()`: `idx > 0`. `hasNext()`: `idx + 1 < len(vals)` or the stack is non-empty.

Values 3, 7, 9, 15, 20: next 3, next 7, prev 3, next 7, next 9.

Do not flatten the whole tree up front if calls are few; the lazy stack keeps memory to O(h + visited).

Time: amortised O(1) per call  
Space: O(h + visited)

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
