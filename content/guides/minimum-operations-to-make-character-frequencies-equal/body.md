## DP for each t

1. cnt = letter counts. For t = 1 … max(cnt), walk letters a … z with state k = copies changed in from the previous letter.
2. For target T ∈ {0, t} and own count c:
   - if c < T: use min(k, T − c) of the incoming copies, insert the rest; carry 0;
   - else: pay c − T for the extra copies; carry 0, or carry c − T to the next letter (not after z).
3. Answer the minimum over t.

Examples → 1, 0, 2. Checked against a breadth-first search over letter counts on 300 random strings with 2–4 letters.

Ignoring the change operation: bcbbaa → 2 instead of 1.

Time: O(26 · max count), at most about 5 · 10^5  
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
