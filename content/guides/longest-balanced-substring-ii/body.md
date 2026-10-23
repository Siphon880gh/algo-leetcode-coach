## Three passes

1. One letter: the longest run of equal letters.
2. For each pair (x, y): reset at every third letter z; d = count(x) − count(y); the answer can be i − first[d].
3. All three: key (a − b, b − c) over the whole string; the answer can be i − first[key].
4. Return the best.

Examples → 4, 3, 2. Checked against testing every substring on 3,000 random strings.

Skipping the one-letter case: constructed check (run in code) "aaab" → 2 instead of 3.

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
