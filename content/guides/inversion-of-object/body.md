Given an object, return a new object whose keys are the original values and whose values are the original keys. How repeated values are handled is in the official statement. For instance, {a: 1, b: 2} becomes {1: a, 2: b}. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Swap

This assumes a value shared by several keys maps to an array of those keys. Adapt the branch if the statement says otherwise.

1. For each [k, v]: if v is new, `r[v] = k`; else if `r[v]` is an array, push k; else `r[v] = [r[v], k]`.
2. Return r.

Constructed checks (run in Node): {a: 1, b: 2, c: 2} → {1: a, 2: [b, c]}.

Plain assignment keeps only the last key: the same input → {1: a, 2: c}.

Time: O(n)  
Space: O(n)

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
