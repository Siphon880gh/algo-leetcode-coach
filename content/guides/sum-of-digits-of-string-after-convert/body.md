## Two phases

1. `t = "".join(str(ord(c) − 96) for c in s)`.
2. Repeat `k` times: `t = str(sum of digits of t)`.
3. Return `int(t)`.

`"iiii", 1` → 36. `"leetcode", 2` → 6. `"zbax", 2` → 8.

The first transform can be done directly on letters: add the digit sum of each position (e.g. 26 → 8) and do `k − 1` more rounds. Never convert the long string to an integer first; it can have 200 digits (fine in Python, not in fixed-width types).

Time: O(n + k)  
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
