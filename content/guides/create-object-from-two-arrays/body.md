Given an array of keys and an array of values, return an object that maps each key to the value at the same index. How a repeated key is handled is in the official statement. For instance, keys [a, b] with values [1, 2] give {a: 1, b: 2}. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Zip

This assumes the first occurrence of a repeated key is kept. If the statement keeps the last one, plain assignment does it.

1. `r = {}`.
2. For each i: if `keys[i]` is not yet in r, set `r[keys[i]] = values[i]`.
3. Return r.

Constructed checks (run in Node): the example above; keys [a, b, a] with values [1, 2, 3] → {a: 1, b: 2}, while plain assignment gives {a: 3, b: 2}.

Object keys are strings, so 1 and '1' are the same key: keys [1, '1'] with values [5, 6] → {1: 5}.

Time: O(n)  
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
