Add a method to every function that takes an object and returns a new function. Calling the new function runs the original with that object as this and passes along all arguments. You may not use the built-in bind. The method name and examples are in the official statement. For instance, binding function f(m) { return this.ctx + "-" + m } to {ctx: "A"} and calling it with "x" gives A-x. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Save this

1. In a regular `function (obj)` method on Function.prototype, `const fn = this`.
2. Return `(...args) => fn.apply(obj, args)`.

Constructed check (run in Node): the example above → A-x.

Define the method with function, not an arrow: an arrow’s this is not the function, and in Node the call throws a TypeError. Forward every argument too; dropping them gives A-undefined.

Time: O(1) per call  
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
