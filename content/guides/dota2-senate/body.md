## Ban the next opponent

Put the indexes of the `R` senators in queue `r` and the `D` senators in queue `d`.

While both queues are non-empty: pop `a` from `r` and `b` from `d`. The smaller index votes first and bans the other. The winner rejoins its queue at `index + n`, which places it in the next round after everyone still waiting.

Return `"Radiant"` if `r` is non-empty, else `"Dire"`.

Banning the next opponent in turn order is optimal: that senator is the one who would act soonest against you.

Do not ban an arbitrary opponent; ban the one whose turn comes next, which is always the front of the other queue. Do not reinsert the winner at its old index; it must wait for the next round.

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
