The letter keys sit in the three usual QWERTY rows, each key at a (row, column) position. One finger starts on a fixed key and types the string s; moving from one key to the next costs the Manhattan distance between their positions. Return the total distance. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Simulate

1. pos[key] = (row, column) from the rows "qwertyuiop", "asdfghjkl", "zxcvbnm".
2. pre = the starting key; for each c: ans += |r₁ − r₂| + |c₁ − c₂|; pre = c.
3. Return ans.

Assumed here: the rows are aligned at column 0 and the finger starts on 'a'.

Constructed checks (made-up strings, run in code): "qa" → 2; "pz" → 21.

Skipping the move from the starting key: "qa" → 1 instead of 2.

Time: O(n)  
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
