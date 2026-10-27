Add a method to every string that returns the string repeated a given number of times, without using the built-in repeat. The method name and limits are in the official statement. For instance, hello repeated 2 times is hellohello, and code repeated 3 times is codecodecode. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Doubling

1. `r = ''`, `b = String(this)`.
2. While `t > 0`: if `t & 1`, `r += b`; `b += b`; `t >>= 1`.
3. Return r.

Constructed checks (run in Node): the examples above; 0 times gives ''; three strings for every count up to 39 match the built-in repeat.

Use `String(this)`: outside strict mode, this inside the method is a String object, not a primitive. A simple loop of t appends also works; doubling needs only O(log t) of them.

Time: O(output length)  
Space: O(output length)

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
