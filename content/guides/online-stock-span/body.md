## Fold smaller days into the new one

`next(price)`:

1. `span = 1`.
2. While the stack is non-empty and its top price `≤ price`: `span += top.span`; pop.
3. Push `(price, span)`; return `span`.

A popped day is never needed again: any later price that reaches past today also reaches past it, and today's span already counts it.

Each price is pushed and popped once.

Do not scan back day by day; that is O(n) per call. Do not use `<` in the pop test; equal prices are part of the span.

Time: O(1) amortized per call  
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
