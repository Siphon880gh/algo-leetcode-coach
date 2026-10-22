Given strings s and t, you may delete at most one character from s. Return the length of the longest common prefix of the result and t. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One skip

1. i = j = 0, used = false.
2. While both remain: equal → advance both; else if not used → used = true, i += 1; else stop.
3. Answer j.

Constructed checks (run in code): abxcd, abcde → 4; abc, xbc → 0. Checked against trying every removal on 1,000 random pairs.

Stopping at the first mismatch without the removal: abxcd, abcde → 2 instead of 4.

Time: O(|s| + |t|)  
Space: O(1)

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
