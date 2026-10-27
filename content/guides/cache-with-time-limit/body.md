## Expiry timestamps

1. `set(key, value, duration)`: `had` = the key exists and has not expired. Store `{value, expires: Date.now() + duration}`; return `had`.
2. `get(key)`: return the value if live, else −1.
3. `count()`: count live entries (or delete expired ones as you go).

Examples → [null,false,42,1,−1], [null,false,true,50,50,−1,0]. Checked in Node with a simulated clock.

A setTimeout per key that deletes it on expiry also works; clear the old timer when a key is overwritten so it does not delete the new value early.

Time: O(1) for set and get, O(keys) for count  
Space: O(keys)

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
