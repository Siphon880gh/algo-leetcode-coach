Given a function and an array of arguments in which some entries are placeholders, return a function that takes more arguments, fills the placeholders with them in order, appends any that are left over, and calls the original. The placeholder value is in the official statement. For instance, with arguments [1, placeholder, 3] and new arguments 2 and 4, the call is made with 1, 2, 3, 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Fill and append

1. Return `(...rest) => { … }`.
2. `a = args.slice()`, `j = 0`; for each i with `a[i]` a placeholder and `j < rest.length`: `a[i] = rest[j++]`.
3. Call `fn(...a, ...rest.slice(j))`.

Constructed checks (run in Node, with _ as the placeholder): the example above → 1, 2, 3, 4; a second call with only 5 → 1, 5, 3.

Fill a copy: changing args in place leaves the first call’s values behind, so that second call → 1, 2, 3, 5 instead of 1, 5, 3.

Time: O(number of arguments) per call  
Space: O(number of arguments)

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
