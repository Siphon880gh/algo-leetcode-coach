## DP

1. f(i, r0, last, off) returns (cars served from i on, smallest maximum wait).
2. For each dispenser j with enough fuel: wait = demand[i − 1] if j = last, else off. Move the clock to car i's start; the other dispenser's leftover becomes max(0, its busy time − wait).
3. Take the option with more cars served, then the smaller max(wait, rest).
4. No car served → −1.

Examples → 6, 0, −1. Checked against trying every assignment on 1,500 random cases.

Sending each car to the dispenser that frees up first: constructed check (run in code) demand = [1, 6, 3], fuel = [7, 1] → 1 instead of 0.

Time: O(n · F · 2 · D · 2) with F ≤ 50 fuel and D ≤ 20  
Space: the same number of states

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
