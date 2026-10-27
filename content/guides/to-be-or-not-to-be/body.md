## Closures

1. `expect(val)` returns `{ toBe(w), notToBe(w) }`.
2. toBe: if `val !== w`, throw `new Error('Not Equal')`; else return true.
3. notToBe: if `val === w`, throw `new Error('Equal')`; else return true.

Examples → {value: true}, {error: Not Equal}, {value: true}. Checked in Node.

Use strict equality: with `!=`, expect(5).toBe('5') returns true instead of throwing.

Time: O(1)  
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
