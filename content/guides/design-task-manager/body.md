## Lazy deletion

1. add / edit: info[task] = (user, priority); push (−priority, −task, user).
2. rmv: delete info[task].
3. execTop: pop until info[task] = (user, priority) from the entry; delete it and return user, or −1 if the heap empties.

Example → [null, null, null, 3, null, null, 5]. Checked against a brute-force scan on 300 random sequences.

Popping without checking the map: the example → 2 instead of 3 at the first execTop (task 102’s old priority 20).

Time: O(log N) amortized per call  
Space: O(N)

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
